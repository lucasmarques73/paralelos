<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="inicio.aspx.cs" Inherits="ExemploComponentes.inicio" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Página Inicial</title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <asp:HyperLink ID="HyperLink1" runat="server" ImageHeight="40px" ImageUrl="~/imagens/inicio.jpg" ImageWidth="40px" NavigateUrl="~/inicio.aspx">Início</asp:HyperLink>
            <asp:HyperLink ID="HyperLink2" runat="server" ImageHeight="40px" ImageUrl="~/imagens/sobre.jpg" ImageWidth="40px" NavigateUrl="~/sobre.aspx">Sobre</asp:HyperLink>
            <br />
            <br />
            <asp:Label ID="Label1" runat="server" Text="Label"></asp:Label>
            <asp:TextBox ID="txtNome" runat="server" Width="187px"></asp:TextBox>
            <asp:Button ID="btnOla" runat="server" Text="Button" OnClick="btnOla_Click" Width="87px" />
            <asp:Label ID="lblNome" runat="server" Text="..."></asp:Label>
            <br />
            <br />
            <asp:DropDownList ID="ddlTime" runat="server" Height="28px" Width="281px" AutoPostBack="True" OnSelectedIndexChanged="ddlTime_SelectedIndexChanged">
                <asp:ListItem Value="1">Corinthians</asp:ListItem>
                <asp:ListItem Value="2">Atletico</asp:ListItem>
                <asp:ListItem Value="3">São Paulo</asp:ListItem>
                <asp:ListItem Value="4">Flamengo</asp:ListItem>
            </asp:DropDownList>
            <asp:Label ID="lblTime" runat="server" Text="..."></asp:Label>
            <br />
            <br />
            <asp:RadioButton ID="rbMasculino" Text="Masculino" runat="server" GroupName="rblSexo" AutoPostBack="True" OnCheckedChanged="rbMasculino_CheckedChanged" />
            <asp:RadioButton ID="rbFeminino" Text="Feminino" runat="server" GroupName="rblSexo" AutoPostBack="True" OnCheckedChanged="rbFeminino_CheckedChanged" />
            <asp:RadioButtonList ID="rblSexo" runat="server"></asp:RadioButtonList>
            <br />
            <asp:Label ID="lblSexo" runat="server" Text="..."></asp:Label>
        </div>
    </form>
</body>
</html>
