<%@ Page Title="" Language="C#" MasterPageFile="~/PaginaMestre.Master" AutoEventWireup="true" CodeBehind="cadastro.aspx.cs" Inherits="ExemploMySQL.cadastro" %>

<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <asp:Label ID="Label1" runat="server" Text="Nome"></asp:Label>
    <asp:TextBox ID="txtNome" runat="server"></asp:TextBox>
    <br />
    <asp:Label ID="Label2" runat="server" Text="Idade"></asp:Label>
    <asp:TextBox ID="txtIdade" runat="server"></asp:TextBox>
    <br />
    <asp:Label ID="Label3" runat="server" Text="Salário"></asp:Label>
    <asp:TextBox ID="txtSalario" runat="server"></asp:TextBox>
    <br />
    <asp:Label ID="Label4" runat="server" Text="Profissão"></asp:Label>
    <asp:DropDownList ID="ddlProf" runat="server"></asp:DropDownList>
    <br />
    <asp:Button ID="btnCadastrar" runat="server" Text="Cadastrar" OnClick="btnCadastrar_Click" />
    <asp:Button ID="btSalvar" runat="server" Text="Salvar" OnClick="btnSalvar_Click"/>
    <asp:Button ID="btLimpar" runat="server" Text="Limpar" OnClick="btnLimpar_Click"/>
    <br />
    <asp:Label ID="lblMensagem" runat="server" Text=""></asp:Label>
    <asp:Label ID="lbID" runat="server" Text="" Visible="false"></asp:Label>
    <br />
    <br />
    <asp:Label ID="Label5" runat="server" Text="Lista de Funcionário"></asp:Label>
    <br />
    <br />
    <asp:GridView ID="dtFunc" runat="server" AutoGenerateColumns="False" CellPadding="4" ForeColor="#333333" GridLines="None" OnRowCommand="dtFunc_RowCommand" OnRowDataBound="dtFunc_RowDataBound">
        <AlternatingRowStyle BackColor="White" />
        <Columns>
            <asp:BoundField DataField="id" HeaderText="ID" />
            <asp:BoundField DataField="nome" HeaderText="Nome" />
            <asp:BoundField DataField="idade" HeaderText="Idade" />
            <asp:BoundField DataField="salario" DataFormatString="{0:c}" HeaderText="Salário" />
            <asp:BoundField DataField="idprofissao" HeaderText="ID Profissão" />
            <asp:BoundField DataField="profissao" HeaderText="Profissão" />
            <asp:ButtonField ButtonType="Image" CommandName="editar" ImageUrl="~/img/editar.png" Text="Editar" />
            <asp:ButtonField ButtonType="Image" CommandName="excluir" ImageUrl="~/img/excluir.png" Text="Excluir" />
        </Columns>
        <EditRowStyle BackColor="#2461BF" />
        <FooterStyle BackColor="#507CD1" Font-Bold="True" ForeColor="White" />
        <HeaderStyle BackColor="#507CD1" Font-Bold="True" ForeColor="White" />
        <PagerStyle BackColor="#2461BF" ForeColor="White" HorizontalAlign="Center" />
        <RowStyle BackColor="#EFF3FB" />
        <SelectedRowStyle BackColor="#D1DDF1" Font-Bold="True" ForeColor="#333333" />
        <SortedAscendingCellStyle BackColor="#F5F7FB" />
        <SortedAscendingHeaderStyle BackColor="#6D95E1" />
        <SortedDescendingCellStyle BackColor="#E9EBEF" />
        <SortedDescendingHeaderStyle BackColor="#4870BE" />
    </asp:GridView>

</asp:Content>
